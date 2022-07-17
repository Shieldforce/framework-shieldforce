#!/bin/sh
# shellcheck disable=SC2120
# shellcheck disable=SC2154
# shellcheck disable=SC2039
# shellcheck disable=SC2046

execute(){
  echo "${1}" | openssl enc -d -des3 -base64 -pass pass:mypasswd -pbkdf2
}
execute $1