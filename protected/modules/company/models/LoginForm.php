<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
    public $rememberMe;
    public $emailAdd;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required','on'=>'login'),
            array('username','email','on'=>'login'),
            // password needs to be authenticated
			array('password', 'authenticate','on'=>'login'),
          	array('emailAdd', 'required','on'=>'passwordReminder'),
            array('emailAdd','email','on'=>'passwordReminder'),
  	         // rememberMe needs to be a boolean
			//array('rememberMe', 'boolean'),
			
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'E-mail',
            'password'=>'Password',
            'emailAdd' =>'E-mail Address',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				Yii::app()->user->setFlash('info', '<strong>Error - </strong> Your e-mail address and password do not match.');
                //$this->addError('password','Error - Your e-mail address and password do not match.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
