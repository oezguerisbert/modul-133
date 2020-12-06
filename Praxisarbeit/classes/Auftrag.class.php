<?php
require_once "./repositories/User.repo.php";
require_once "./repositories/Service.repo.php";
require_once "./repositories/Priority.repo.php";
require_once "./repositories/Kommentar.repo.php";
// require_once "../repositories/Auftrag.repo.php";
class Auftrag
{
    private $id;
    private $userid;
    private $prioid;
    private $serviceid;
    private $visible;
    private $modeid;

    public function getID()
    {
        return $this->id;
    }
    public function getUser(): User
    {
        return UserRepository::find($this->userid);
    }
    public function getPriority(): Priority
    {
        return PriorityRepository::find($this->prioid);
    }
    public function getService(): Service
    {
        return ServiceRepository::find($this->serviceid);
    }

    public function getMode() {
        return ModusRepository::find($this->modeid);
    }

    public function getModeAsKuerzel() {
        return ModusRepository::find($this->modeid)->getKuerzel();
    }

    public function isNew() {
        return ModusRepository::find($this->modeid)->getKuerzel() === "n";
    }

    public function isDeclined() {
        return ModusRepository::find($this->modeid)->getKuerzel() === "c";
    }
    public function isHidden() {
        return !$this->isVisible();
    }
    public function isAccepted() {
        return ModusRepository::find($this->modeid)->getKuerzel() === "a";
    }
    public function getComments(){
        $comments = KommentarRepository::findAll($this->getID());
        $d = "";
        if(sizeof($comments) > 0){
            foreach ($comments as $key => $comment) {
                $d .= "<div class=\"bg-secondary\">
    
                </div>";
            }
        }else {
            $d = "<div class=\"mt-2 mb-2 col-md-12 p-4 vw-100 border bg-light rounded\" style=\"border-color:#bfc0c0;\">
                <div class=\"p-2 text-center\" style=\"color:#7f7f7f;\">Keine Kommentare. <a href=\"comment.php?aid=".$this->getID()."\" target=\"newTab\">Hinzufügen?</a></div>
            </div>";
        }
        
        return $d;
    }

    public function isFinished() {
        return ModusRepository::find($this->modeid)->getKuerzel() === "f";
    }
    public function getVisibleIcon(){
        return "fa-eye".($this->isVisible() ? "-slash" : "");
    }
    public function isVisible()
    {
        return $this->visible;
    }

    public function toHTML() {
        return "<div class=\"card vw-100\">
        <div class=\"card-body\">
          <h5 class=\"card-title\">".$this->getService()->getTitle()."</h5>
          <h6 class=\"card-subtitle mb-2 text-muted\">@".$this->getUser()->getUsername()."<span class=\"badge badge-secondary ml-2\">".$this->getPriority()->getTitle()."</span></h6>
          <p class=\"card-text\">".$this->getService()->getDescription()."</p>
          ".$this->getComments()."
          <div class=\"d-flex w-100 \">
            <div class=\"ml-auto\"></div>
            ".
            ($this->isNew() ?
                "<a href=\"auftrag.php?id=".$this->getID()."&m=c\" class=\"fa fa-ban ml-2 text-danger text-decoration-none\"></a>
                <a href=\"auftrag.php?id=".$this->getID()."&m=e\" class=\"fa fa-check ml-2 text-success text-decoration-none\"></a>"
                    :
                    "<a href=\"auftrag.php?id=".$this->getID()."&v=".($this->isVisible() ? "0":"1")."\" class=\"fa ".$this->getVisibleIcon()." ml-auto text-secondary text-decoration-none\"></a>".
                    ($this->isDeclined() ?
                        "<div class=\"fa fa-ban ml-2 text-danger text-decoration-none\"></div>"
                            :
                        "<a href=\"auftrag.php?id=".$this->getID()."&m=e\" class=\"fa fa-check ml-2 text-success text-decoration-none\"></a>"
            ))."
          </div>
        </div>
      </div>";
    }

    public function toRow()
    {
        return "
            <tr style=\"cursor: pointer;\" onclick=\"location.href= './auftrag.php?id=" . $this->getID() . "';\">
                <th scope=\"row\">" . $this->getID() . "</th>
                <td>" . $this->getUser()->getUsername() . "</td>
                <td>" . $this->getService()->getTitle() . "</td>
                <td>" . $this->getPriority()->getKuerzel() . "</td>
            </tr>";
    }
}
