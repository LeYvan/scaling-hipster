<?php

require_once (".secure.php");

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendSmsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'sms:send';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Look for new alerts and sens sms accordingly.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
			$this->sent = 0;

			$alertes = Alerte::where('sent_sms',false)->get();
			$utilisateurs = Utilisateur::where('sms','!=',"")->get();

			$this->info(date("G:i:s"));

			foreach($alertes as $alerte)
			{
				$old = $this->sent;
				foreach ($utilisateurs as $utilisateur)
				{
					$this->sendSms($alerte,$utilisateur);
					$this->info("Envoyé " . ($this->sent - $old) . " sms pour l'alerte id=" . $alerte->id . ".");
				}

			}

			$this->info("Envoyé " . $this->sent . " sms en tout.");
	}

	private function sendSms($alerte,$utilisateur)
	{
	  global $account_sid, $auth_token;

	  //$this->info("WOA: $account_sid, $auth_token");

	  try {
	  	$client = new Services_Twilio($GLOBALS['account_sid'], $GLOBALS['auth_token']); 
	   
		  $client->account->messages->create(array( 
		      'To' => $utilisateur->sms, 
		      'From' => "+15817029591", 
		      'Body' => "Alerte faireface.ca: " . $alerte->contenu . "\r\nfaireface.ca/a/" . $alerte->id,   
		  ));

		  $this->sent++;

		  $alerte->sent_sms = true;
		  $alerte->save();

		  $this->info('Envoyé "' . $alerte->id . '" à "' . $utilisateur->id . '"');
	  } 
	  catch(Exception $e)
	  {
			$this->error("sendSms.erreur.msg: " . $e->getMessage() . ".");
	  }

		
	}
}
