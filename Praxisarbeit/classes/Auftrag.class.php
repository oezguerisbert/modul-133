<?php
// include "User.class.php";
// include "Service.class.php";
// include "Priority.class.php";
// include "DB.class.php";
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
        return DB::getUser($this->userid);
    }
    public function getPriority(): Priority
    {
        return DB::getPriority($this->prioid);
    }
    public function getService(): Service
    {
        return DB::getServiceByID($this->serviceid);
    }
    public function toRow()
    {
        return "<tr>
            <th scope=\"row\">" . $this->getID() . "</th>
            <td>" . $this->getUser()->getUsername() . "</td>
            <td>" . $this->getService()->getTitle() . "</td>
            <td>" . $this->getPriority()->getKuerzel() . "</td>
        </tr>";
    }
}
