<?php
namespace Application\Controller;

use Application\Service\UserServiceInterface;
use Zend\Db\Sql\Predicate\Like;
use Zend\Db\Sql\Where;
use Zend\InputFilter\InputFilterInterface;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    /**
     * @var UserServiceInterface
     */
	protected $userService;

    /**
     * @var InputFilterInterface
     */
    protected $signupFormFilter;   

	/**
	 * Constructor
	 *
	 * @param UserServiceInterface $userService
	 * @param InputFilterInterface $signupFormFilter
	 * @return void
	 */
	public function __construct(
		UserServiceInterface $userService,
		InputFilterInterface $signupFormFilter
	) {		
		$this->userService = $userService;
		$this->signupFormFilter = $signupFormFilter;		
	}	

	public function indexAction()
	{
		$userEntities = $this->userService->getUserByFilter();
		$userData = $userEntities->toArray();

		// User data with pagination
		// $paginator = new Paginator(new ArrayAdapter($userData));
		// $paginator->setItemCountPerPage(5);
		// $paginator->setCurrentPageNumber($this->params()->fromRoute('page'));

		return new ViewModel([
			'users' => $userData,
		]);
	}
	
	public function allUsersAction()
	{
        $request = $this->getRequest();
        $response = $this->getResponse();
		$response->getHeaders()->addHeaderLine("Content-Type", "application/json");

        // Checks if the request is valid
	    if (!$request->isPost() || !$request->isXmlHttpRequest()) {
			$response->setContent(Json::encode(['error' => ['Very bad request']]));
			return $response;
	    }

	    // Gets user data
        $data = $this->getFormattedDataForDatatable();

        $response->setContent(Json::encode($data));
        return $response;

		// return new JsonModel($data);
	}		

	/**
	 * Prepares formatted data for datatable
	 * 
	 * @return array
	 */
	protected function getFormattedDataForDatatable()
	{
        $request = $this->getRequest();

		// Gets values for datatable from the request
        $draw = intval($request->getPost('draw'));
        $limit = intval($request->getPost('length'));
        $offset = intval($request->getPost('start'));

        // Prepares Where clause
        $search = strip_tags($request->getPost('search')['value']);
        if (!empty($search)) {
    		// Where clause using array
    		// $where = [
    		// 	new Like('firstname', $search, '%'),
    		// 	new Like('lastname', $search, '%'),
    		// 	new Like('email', $search, '%'),
    		// 	new Like('id', $search, '%'),
    		// ];

    		// Where clause using closure
    		$where = function(Where $where) use($search) {
    			$where->like('firstname', "%$search%")
    			->or->like('lastname', "%$search%")
    			->or->like('email', "%$search%")
    			->or->like('id', "%$search%");
    		};
	    } else {
	    	$where = null;
	    }
        
        // Prepare value for ORDER BY clause if provided
        $order = $request->getPost('order');
        if (!empty($order)) {
        	$columns = [
        		0 => 'id',
        		1 => 'firstname',
        		2 => 'lastname',
        		3 => 'email',
        	];
        	$columnNumber = intval($request->getPost('order')['0']['column']);
        	// $column = strval($request->getPost('columns')[$columnNumber]['data']);
        	$column = $columns[$columnNumber];
        	$dir = strval($request->getPost('order')['0']['dir']);
        	$orderBy = "$column $dir";
        } else {
        	$orderBy = "id asc";
        }
     
        // Gets filtered data
		$userEntities = $this->userService->getUserByFilter($where, $orderBy, $limit, $offset);
		$filteredUsers = $userEntities->toArray();

		// Prepares data for datatable
		$tableContent = [];
		foreach ($filteredUsers as $user) {

			// If data need for datatable as objects
			// $prepareData = [];
			// $prepareData['id'] = $user['id'];
			// $prepareData['firstname'] = $user['firstname'];
			// $prepareData['lastname'] = $user['lastname'];
			// $prepareData['email'] = $user['email'];
			// $prepareData['edit'] = sprintf('<span class="glyphicon glyphicon-edit edit-this-user" aria-hidden="true" data-userid="%d"></span>', $user['id']);
			// $prepareData['delete'] = sprintf('<span class="glyphicon glyphicon-trash delete-this-user" aria-hidden="true" data-userid="%d"></span>', $user['id']);
			// $tableContent[] = $prepareData;
			// unset($prepareData);

			// If data need for datatable as arrays
			$prepareData = [];
			$prepareData[] = $user['id'];
			$prepareData[] = $user['firstname'];
			$prepareData[] = $user['lastname'];
			$prepareData[] = $user['email'];
			$prepareData[] = sprintf('<span class="glyphicon glyphicon-edit user-action-button" id="edit-this-user" aria-hidden="true" data-userid="%d"></span>', $user['id']);
			$prepareData[] = sprintf('<span class="glyphicon glyphicon-trash user-action-button" aria-hidden="true" data-userid="%d" data-toggle="modal" data-target="#user-delete-modal"></span>', $user['id']);
			$tableContent[] = $prepareData;	
		}

		// Makes appropriate total for pagination
		if (null === $where) {
			$allUsers = $this->userService->getUserByFilter();
			$recordsTotal = count($allUsers);
			$recordsFiltered = $recordsTotal;
		} elseif (null !== $where) {
			$userEntities = $this->userService->getUserByFilter($where);
			$recordsTotal = count($userEntities->toArray());
			$recordsFiltered = $recordsTotal;
		}

		// Prepares data available for datatable
        $data = [
        	'draw' => $draw,
        	'recordsTotal' => $recordsTotal,
        	'recordsFiltered' => $recordsFiltered,
        	'data' => $tableContent,
        ];       

        return $data;
	}

	public function handleAction()
	{
        $request = $this->getRequest();
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine("Content-Type", "application/json");

        // Checks if the request is valid
	    if (!$request->isPost() || !$request->isXmlHttpRequest()) {
			$response->setContent(Json::encode(['error' => ['Very bad request']]));
			return $response;
	    }	    

	    $rawUserId = $request->getPost('userId');
	    $userId = (int) $rawUserId;

		$filter = $this->signupFormFilter;
		$filter->setData($request->getPost());

		if (!empty($userId) && is_int($userId)) {
			if (!$filter->isValid()) {
				$errorMessages = $filter->getMessages();
				foreach ($errorMessages as $messages) {
					foreach ($messages as $message) {
						$errors[] = $message;
					}
				}
				$response->setContent(Json::encode(['error' => $errors]));
				return $response;
			}	    

			// Gets the data and user ID
			$data = $filter->getValues();
			$userId = (int) $data['userId'];
			unset($data['userId']);			

			if ($this->userService->updateUser($data, ['id' => $userId])) {
				$response->setContent(Json::encode(['success' => 'User updated']));
			} else {
				$response->setContent(Json::encode(['error' => ['Change any data and try again']]));
			}
		} else {
			if (!$filter->isValid()) {
				$errorMessages = $filter->getMessages();
				foreach ($errorMessages as $message) {
					foreach ($message as $msg) {
						$errors[] = $msg;
					}
				}
				$response->setContent(Json::encode(['error' => $errors]));
				return $response;
			}	    

			// Gets the data and user ID
			$data = $filter->getValues();
			$userId = (int) $data['userId'];
			unset($data['userId']);

			if ($userId = $this->userService->registerUser($data)) {
				$response->setContent(Json::encode(['success' => 'User created', 'userId' => $userId])); 
			} else {
				$response->setContent(Json::encode(['error' => ['Could not create user']]));
			}
		}

		return $response;
	}

	public function singleUserAction()
	{
        $request = $this->getRequest();
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine("Content-Type", "application/json");

        // Checks if the request is valid
	    if (!$request->isPost() || !$request->isXmlHttpRequest()) {
			$response->setContent(Json::encode(['error' => ['Very bad request']]));
			return $response;
	    }

	    $userId = intval($request->getPost('userId'));
    	$userDetails = $this->userService->getUserById($userId);
    	if ($userDetails) {
    		$response->setContent(Json::encode(['user' => $userDetails]));
    	} else {
    		$response->setContent(Json::encode(['error' => ['User not found']]));
    	}
		
		return $response; 
	}	

	public function deleteUserAction()
	{
        $request = $this->getRequest();
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine("Content-Type", "application/json");

        // Checks if the request is valid
	    if (!$request->isPost() || !$request->isXmlHttpRequest()) {
			$response->setContent(Json::encode(['error' => ['Very bad request']]));
			return $response;
	    }

	    $userId = intval($request->getPost('userId'));
    	if ($this->userService->deleteUser(['id' => $userId])) {
    		$response->setContent(Json::encode(['success' => "User deleted"]));
    	} else {
    		$response->setContent(Json::encode(['error' => ['Could not find the user']]));
    	}
		
		return $response; 		
	}
				
}