<?php

//Exceptions for loginview.
class UsernameMissing extends Exception
{ }
class PasswordMissing extends Exception
{ }
class WrongCredentials extends Exception
{ }

//Exceptions for registerview.
class UsernameToShort extends Exception
{ }
class PasswordToShort extends Exception
{ }
