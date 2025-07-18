<?php

namespace addons\carswxsys\controller;


use addons\carswxsys\service\Token;


class BaseController extends \think\addons\Controller
{
    
 
    protected function checkExclusiveScope()
    {
        Token::needExclusiveScope();
    }

    protected function checkPrimaryScope()
    {
        Token::needPrimaryScope();
    }

    protected function checkSuperScope()
    {
        Token::needSuperScope();
    }
}