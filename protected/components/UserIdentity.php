<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    public $_id;
    public function authenticate()
    {
        
        $record= Member::model()->findByAttributes(array('email'=>$this->username));
        
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==sha1($this->password) || $record->password=='')
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else if($record->is_verified == '0')
        {
            die("Not Verified");
        }
        else
        {
            $this->_id=$record->id;
            $this->setState('name', $record->fname);
            $this->setState('email', $record->email);
            $this->errorCode=self::ERROR_NONE;
            $record->total_logins=$record->total_logins+1;
            $record->save(false); 
            $memberLogin = new MemberLogin;
            $memberLogin->member_id = $record->id;
            $memberLogin->login_date = date('Y-m-d H:i:s');
            $memberLogin->save();
            
                                        
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
    
  /*
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
    */
}