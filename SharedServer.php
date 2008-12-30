<?php  

require_once('light/Server.php');
require_once('light/JsonEncoder.php');

/**
 * Extends the functionality of Server to add auto-joining and persistent data
 * Also relays only to others on update events
 *
 * Needs to store the old values and versions
 * 
 * Conflict detection
 * 
 * 
 */
class SharedServer extends Server
{
	function SharedServer($host='localhost',$port=8080)
	{
		Message::$encoder = new JsonEncoder();  
		parent::__construct($host, $port);
	}
	
	protected function handleMessage($message)
	{
		switch ($message->type)
		{            
			case 'join': 			$this->onJoin($message); break; 
			case 'update': 			$this->onUpdate($message); break; 
			default:				parent::handleMessage($message); break;
		}
	}
	
	protected function onJoin($message)
	{
		// Leave existing channel first!
		$this->channels->leave($message->from);
		
		// Join the new channel
		$this->channels->join($message->from, $message->data);
	}
	
	protected function onUpdate($message)
	{
		// send to everyone but you!
		$this->send($message->from->getOtherChannelMembers(), $message);
	}
} 
?>