<?php
require_once "./repositories/User.repo.php";
require_once "./repositories/Auftraege.repo.php";
class Kommentar
{
    private $id;
    private $userid;
    private $auftragid;
    private $content;

    public function getID()
    {
        return $this->id;
    }
    public function getUser()
    {
        return UserRepository::find($this->userid);
    }
    public function getAuftrag()
    {
        return AuftragRepository::find($this->auftragid);
    }
    public function getContent()
    {
        return $this->content;
    }

}
