<?php
require 'protected/3rd Party/passwordLib/passwordLib.php';
class SiteController extends Controller
{
        public $message = "";
        public $help = "";
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

        

	/*
	 * This is the action to handle external exceptions.
	 
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

        
            }
            $this->render($page,$dataArray);  
        }
        else{
            $url = Yii::app()->createUrl('site/LoginView');      
            $this->redirect($url, array("message"=>"Please Login to Continue"));
        }       
    }

    *//*
     * Displays the login page*/
    
        
       
    public function actionViewAddMember(){
        $this->render('AddMember',array("message"=>""));        
    }

    public function actionGoHome(){
        $this->render('index',array("message"=>""));
    }

    public function actionRemoveMember(){
$message = $_POST['memberId'];
       $member = Member::model()->findByPk($_POST['memberId']);
        $memberSermons = MemberSermon::model()->findAllByAttributes(array("MEMBERID"=>$member->ID));
       try{
        $bad = '';
        foreach($memberSermons as $memberSermon){
            if($memberSermon->Delete()){


$message = "sermon deleted";
            }
            else{
                $result = "Couldn't remove all Members! ";
                $result.= json_encode($memberSermon->getErrors());
                echo "bad";
                $bad = 'bad';
            }
        }

        if($bad === '' && $member->Delete()){
                $message = "member deleted";
        }else{
            $message = "member not deleted";
        }
    }catch(Exception $e){
        $message = json_encode($e);
    }
        $members = Member::model()->findAll();
        $stats = $this->getStatusArray();
       echo CJSON::encode(array('message'=>$message, 'members'=>$members, 'statuses'=>$stats));   
    }

    public function actionAddMember(){
        $result = '';
        $transaction = Yii::app()->db->beginTransaction();
        $member = new Member();
        $member->FIRSTNAME = $_POST['firstName'];
        $member->LASTNAME = $_POST['lastName'];
        $member->STATUSID = $_POST['status'];
        //$member->BIRTHDAY = $_POST['Birthday'];
        if($member->save()){
            $transaction->commit();
            $result = "Member Added!";
        }
        else{
            $result = "Member Could Not Be Added!";
            $result .= " ".json_encode($member->getErrors());
            $transaction->rollBack();
        }
        $members = Member::model()->findAll();
        $stats = $this->getStatusArray();
       echo CJSON::encode(array('message'=>$result, 'members'=>$members, 'statuses'=>$stats)); 
    }
    public function getStatusArray(){
        $statuses = Status::model()->findAll();
        $stats = [];
        foreach($statuses as $status){
            $stats[$status->ID] = $status->STATUS;
        }
        return $stats;
    }

    public function getMember($id){ 
        return Member::model()->findByPk($id);
    }

    public function getStatuses(){
        $statuses = Status::model()->findAll();
        return $statuses;
    }

    public function actionGetAllSermonDates(){
        return SermonDate::model()->findAll();
    }

    public function actionAddSermonDate(){
        $date = $_POST['Date'];
        $sermonDate = new SermonDate();
        $sermonDate->DATE = $date;
    }

    public function actionGetRecentSermonDates(){

    }

    public function getSermonDates($lessThanDate,$greaterThanDate){
        $sermonDates = SermonDate::model()->findByAttributes(   
            array(
                  'condition' => 'SERMONDATE >= :greaterThanDate',
                  'params' => array('greaterThanDate'=>$greaterThanDate)
             ));

        $criteria = new CDbCriteria;
        $criteria->select = 'sermondate.* as sd'; // select fields which you want in output
        $criteria->condition = 'sd.SERMONDATE >= '.$greaterThanDate. ' and sd.SERMONDATE <= ' .$lessThanDate;

        $data = SermonDate::model()->findAll($criteria);
        $levelList=CHtml::ListData($data,'guest_cc_id','cardNameNo');
    }
}
