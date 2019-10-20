<?php

namespace Model;

class Authenticator
{
  public function hasValidPassword(\Model\MemberCredentials $member, string $enteredPassword): bool
  {
    if ($member->password == $enteredPassword) {
      return true;
    } else {
      throw new \WrongCredentials();
    }
  }
}
