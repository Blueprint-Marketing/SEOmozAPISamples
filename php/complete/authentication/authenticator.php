<?php
/**
 * The authentication class which is used to generate the authentication string
 *
 * @author SEOmoz
 */
class Authenticator {
	/**
	 * accessID The user's Access ID
	 */
	private $accessID;

	/**
	 * secretKey The user's Secret Key
	 */
	private $secretKey;

	/**
	 * expiresInterval The interval after which the authentication string expires
	 * Default 300s
	 */
	private $expiresInterval = 300;

	/**
	 * rateLimit The duration between when the requests are made
	 * Default 10s
	 */
	private $rateLimit = 10;

	/**
	 *
	 * This method calculates the authentication String based on the
	 * user's credentials.
	 *
	 * Set the user credentials before calling this method
	 *
	 * @return the authentication string
	 *
	 * @see #setAccessID(String)
	 * @see #setSecretKey(String)
	 */
	public function getAuthenticationStr() {

		$expires = time() + $this->expiresInterval;

		$stringToSign = $this->accessID."\n".$expires;

		$binarySignature = hash_hmac('sha1', $stringToSign, $this->secretKey, true);

		// We need to base64-encode it and then url-encode that.

		$urlSafeSignature = urlencode(base64_encode($binarySignature));

		$authenticationStr = "AccessID=".$this->accessID."&Expires=".$expires."&Signature=".$urlSafeSignature;

		return $authenticationStr;
	}

	/**
	 * @return the $accessID
	 */
	public function getAccessID() {
		return $this->accessID;
	}

	/**
	 * @return the $secretKey
	 */
	public function getSecretKey() {
		return $this->secretKey;
	}

	/**
	 * @param $accessID the $accessID to set
	 */
	public function setAccessID($accessID) {
		$this->accessID = $accessID;
	}

	/**
	 * @param $secretKey the $secretKey to set
	 */
	public function setSecretKey($secretKey) {
		$this->secretKey = $secretKey;
	}

	/**
	 * @return the $expiresInterval
	 */
	public function getExpiresInterval() {
		return $this->expiresInterval;
	}

	/**
	 * @return the $rateLimit
	 */
	public function getRateLimit() {
		return $this->rateLimit;
	}

	/**
	 * @param $rateLimit the $rateLimit to set
	 */
	public function setRateLimit($rateLimit) {
		$this->rateLimit = $rateLimit;
	}

	/**
	 * @param $expiresInterval the $expiresInterval to set
	 */
	public function setExpiresInterval($expiresInterval) {
		$this->expiresInterval = $expiresInterval;
	}

}
?>