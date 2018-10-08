<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 18:57
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Classes\Task;

class MainController extends Controller
{
    public function MainController()
    {
        return ;
    }

    public function CreateController()
    {
        $task = new Task();


    }

    public function RemoveController()
    {

    }

    public function UpdateController()
    {

    }

}