<?php

    function createUsers(array $users){
        $d = "";
        
        foreach ($users as $userid => $user) {
            $d .= "<div class=\"m-auto\">
                    <div class=\"card\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title text-center\">".$user['username']."</h5>
                            <form class=\"d-flex align-items-center\" action=\"login.php\" method=\"POST\">
                                <div class=\"form-group pt-4\">
                                    <input name=\"username\" type=\"text\" value=\"".$user['username']."\" hidden/>
                                    <input name=\"password\" type=\"password\" class=\"form-control\" id=\"password\" placeholder=\"Password\" required/>
                                    <button class=\"btn btn-primary mt-3 align-self-end\" type=\"submit\">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>";
        }
        $d .="<div class=\"card m-auto border-0\">
                <div class=\"card-body\">
                    <a href=\"register.php\" class=\"btn btn-lg btn-primary\">Register</a>
                </div>
            </div>";
        return $d;
    }

?>