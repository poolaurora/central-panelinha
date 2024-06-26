<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\Http;
use App\Models\EmailAccount;

class CheckEmails extends Command
{
    // O nome e a assinatura do comando
    protected $signature = 'emails:check';

    // A descrição do comando
    protected $description = 'Verifica novos e-mails em contas configuradas';

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
    public function handle()
    {
        $emailAccounts = EmailAccount::all();

        if ($emailAccounts->isEmpty()) {
            return;
        }

        foreach ($emailAccounts as $account) {
            $this->checkEmailAccount($account);
        }
    }

    private function checkEmailAccount($account)
    {
        $client = Client::make([
            'host'          => $account->imap_host,
            'port'          => $account->imap_port,
            'encryption'    => $account->imap_encryption,
            'validate_cert' => $account->imap_validate_cert,
            'username'      => $account->email,
            'password'      => $account->password,
            'protocol'      => 'imap'
        ]);

        try {
            // Conectar ao servidor IMAP
            $client->connect();

            // Selecionar a pasta INBOX
            $folder = $client->getFolderByName('INBOX');

            // Buscar e-mails não lidos
            $messages = $folder->query()->unseen()->get();

            foreach ($messages as $message) {
                $from = $message->getFrom()[0]->mail;
                $subject = str_replace('_', ' ', $message->getSubject());
            
                // Formatar mensagem do webhook
                $content = "Você recebeu um novo e-mail\n";
                $content .= "E-mail do remetente: {$from}\n";
                $content .= "E-mail destinatário: {$account->email}\n";
                $content .= "Assunto: {$subject}\n";
                $content .= "------------------------------";
            
                // Enviar mensagem ao Discord
                Http::post(env('DISCORD_WEBHOOK_URL'), [
                    'content' => $content
                ]);
            
                // Marcar e-mail como lido
                $message->setFlag('Seen');
            }            
        } catch (\Exception $e) {
            // Tratar erro se necessário
        }
    }
}
