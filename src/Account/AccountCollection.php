<?php

namespace h4kuna\Fio\Account;

use h4kuna\Fio\AccountException;

/**
 * @author Milan Matějček
 */
class AccountCollection
{

	/** @var Account[] */
	private $accounts;

	/** @var string */
	private $active;

	public function setActive($name)
	{
		$this->accountExists($name);
		$this->active = $name;
		return $this;
	}

	/** @return Account */
	public function getActive()
	{
		return $this->accountExists($this->active);
	}

	/**
	 * @return Account
	 * @throws AccountException
	 */
	private function accountExists($alias)
	{
		if (isset($this->accounts[$alias])) {
			return $this->accounts[$alias];
		}
		throw new AccountException('This account alias does not exists. ' . $alias);
	}

	public function addAccount($alias, Account $account)
	{
		$this->accounts[$alias] = $account;
		if ($this->active === NULL) {
			$this->setActive($alias);
		}
	}

}