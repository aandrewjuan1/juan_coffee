<?php

class Authenticated
{
    public function handle()
    {
        if (! $_SESSION['user'] ?? false) {
            redirect('/juan_coffee/');

        }
    }
}