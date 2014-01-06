<?php

/**
 * RedUNIT Shared Test Classes / Mock Objects
 * This file contains a collection of test classes that can be used by
 * and shared by tests.
 */

/**
 * Observable Mock
 * This is just for testing
 */
class ObservableMock extends \RedBeanPHP\Observable
{
	/**
	 * @param $eventname
	 * @param $info
	 */
	public function test( $eventname, $info )
	{
		$this->signal( $eventname, $info );
	}
}

/**
 * Observer Mock
 * This is just for testing
 */
class ObserverMock implements \RedBeanPHP\Observer
{
	/**
	 * @var bool
	 */
	public $event = FALSE;

	/**
	 * @var bool
	 */
	public $info = FALSE;

	/**
	 * @param string $event
	 * @param        $info
	 */
	public function onEvent( $event, $info )
	{
		$this->event = $event;
		$this->info  = $info;
	}
}

/**
 * Shared helper class for tests.
 * A test model to test FUSE functions.
 */
class Model_Band extends RedBeanPHP\SimpleModel
{
	public function after_update() { }

	/**
	 * @throws Exception
	 */
	public function update()
	{
		if ( count( $this->ownBandmember ) > 4 ) {
			throw new Exception( 'too many!' );
		}
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return 'bigband';
	}

	/**
	 * @param $prop
	 * @param $value
	 */
	public function setProperty( $prop, $value )
	{
		$this->$prop = $value;
	}

	/**
	 * @param $prop
	 *
	 * @return bool
	 */
	public function checkProperty( $prop )
	{
		return isset( $this->$prop );
	}
}

/**
 * Shared helper class for tests.
 * A Model class for testing Models/FUSE and related features.
 */
class Model_Box extends RedBeanPHP\SimpleModel
{
	public function delete() { $a = $this->bean->ownBottle; }
}

/**
 * Shared helper class for tests.
 * A Model class for testing Models/FUSE and related features.
 */
class Model_CandyBar extends RedBeanPHP\SimpleModel
{
	/**
	 * @param $custom
	 *
	 * @return string
	 */
	public function customMethod( $custom )
	{
		return $custom . "!";
	}

	/**
	 * @throws Exception
	 */
	public function customMethodWithException()
	{
		throw new Exception( 'Oops!' );
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return 'candy!';
	}
}

/**
 * Shared helper class for tests.
 * A Model class for testing Models/FUSE and related features.
 */
class Model_Cocoa extends RedBeanPHP\SimpleModel
{
	public function update()
	{
		//print_r($this->sharedTaste);
	}
}

/**
 * Shared helper class for tests.
 * A Model class for testing Models/FUSE and related features.
 */
class Model_Taste extends RedBeanPHP\SimpleModel
{
	public function after_update()
	{
		asrt( count( $this->bean->ownCocoa ), 0 );
	}
}

/**
 * Shared helper class for tests.
 * A Model class for testing Models/FUSE and related features.
 */
class Model_Coffee extends RedBeanPHP\SimpleModel
{
	public function update()
	{
		while ( count( $this->bean->ownSugar ) > 3 ) {
			array_pop( $this->bean->ownSugar );
		}
	}
}

/**
 * Shared helper class for tests.
 * A Model class for testing Models/FUSE and related features.
 */
class Model_Test extends RedBeanPHP\SimpleModel
{
	public function update()
	{
		if ( $this->bean->item->val ) {
			$this->bean->item->val        = 'Test2';
			$can                          = R::dispense( 'can' );
			$can->name                    = 'can for bean';
			$s                            = reset( $this->bean->sharedSpoon );
			$s->name                      = "S2";
			$this->bean->item->deep->name = '123';
			$this->bean->ownCan[]         = $can;
			$this->bean->sharedPeas       = R::dispense( 'peas', 10 );
			$this->bean->ownChip          = R::dispense( 'chip', 9 );
		}
	}
}

global $lifeCycle;

/**
 * Shared helper class for tests.
 * A Model class for testing Models/FUSE and related features.
 */
class Model_Bandmember extends RedBeanPHP\SimpleModel
{
	public function open()
	{
		global $lifeCycle;

		$lifeCycle .= "\n called open: " . $this->id;
	}

	public function dispense()
	{
		global $lifeCycle;

		$lifeCycle .= "\n called dispense() " . $this->bean;
	}

	public function update()
	{
		global $lifeCycle;

		$lifeCycle .= "\n called update() " . $this->bean;
	}

	public function after_update()
	{
		global $lifeCycle;

		$lifeCycle .= "\n called after_update() " . $this->bean;
	}

	public function delete()
	{
		global $lifeCycle;

		$lifeCycle .= "\n called delete() " . $this->bean;
	}

	public function after_delete()
	{
		global $lifeCycle;

		$lifeCycle .= "\n called after_delete() " . $this->bean;
	}
}
