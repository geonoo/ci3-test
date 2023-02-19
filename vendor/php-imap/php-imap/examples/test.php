<?php

    /**
     * Example: 
     *
     * @author Sebastian Krätzig <info@ts3-tools.info>
     */
    declare(strict_types=1);

    require_once __DIR__.'/../../../autoload.php';

    use PhpImap\Exceptions\ConnectionException;
    use PhpImap\Mailbox;

    $mailbox = new Mailbox(
        '{imap.naver.com:993/imap/ssl}',
        '',
        ''
    );

    try {
        echo "Start\n";
        $mailFolderList = $mailbox->getListingFolders();
        foreach ($mailFolderList as $folder) {
            $folder_name = explode("}", $folder)[1];
            echo "folder : ".$folder."\n";

            $mailbox->switchMailbox($folder);

            $file_path = "/data/todowith/".$folder_name;

            echo "file path : ".$file_path."\n";

            if( !is_dir($file_path) ) {
                mkdir($file_path, 0644, true);
            }

            $mail_ids = $mailbox->searchMailbox('ALL');
            
            foreach ($mail_ids as $mail_id) {
                echo "+------ S A V I N G --".$mail_id."---+\n";
                $saveFile = $file_path.'/'.$mail_id.'.eml';
                $mailbox->saveMail($mail_id, (string) $saveFile);
            }
        }
    } catch (ConnectionException $ex) {
        exit('IMAP connection failed: '.$ex->getMessage());
    } catch (Exception $ex) {
        exit('An error occured: '.$ex->getMessage());
    }

    $mailbox->disconnect();
