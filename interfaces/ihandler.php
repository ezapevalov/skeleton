<?php

interface iHandler
{
    public function dispatchAction($action,&$app);
    public function actionIndex(&$app);
}