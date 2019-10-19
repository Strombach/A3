<?php

//Exceptions for loginview.
class UsernameMissing extends Exception
{ }
class PasswordMissing extends Exception
{ }
class WrongCredentials extends Exception
{ }

//Exceptions for registerview.
class UsernameTooShort extends Exception
{ }
class PasswordTooShort extends Exception
{ }
class PasswordsNotMatching extends Exception
{ }
class InvalidCharacters extends Exception
{ }
