<?php
require_once "./repositories/User.repo.php";
require_once "./repositories/Service.repo.php";
require_once "./repositories/Priority.repo.php";
// require_once "../repositories/Auftrag.repo.php";
class Auftrag
{
    private $id;
    private $userid;
    private $prioid;
    private $serviceid;

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
    public function toRow()
    {
        return "
            <tr style=\"cursor: pointer;\" onclick=\"window.open('./auftrag.php?id=" . $this->getID() . "')\">
                <th scope=\"row\">" . $this->getID() . "</th>
                <td>" . $this->getUser()->getUsername() . "</td>
                <td>" . $this->getService()->getTitle() . "</td>
                <td>" . $this->getPriority()->getKuerzel() . "</td>
            </tr>";
    }
}
