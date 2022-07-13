#!/bin/sh
# shellcheck disable=SC2039
# shellcheck disable=SC2154
# shellcheck disable=SC2046

echo "----------------------- ##### Setup (Passo 1 Iniciado!) ##### -----------------------"
echo "-"
echo "-"
echo "- Informações do banco : "
echo -n > config/db/.credentials

declare  -A arrayInfo

# insert DB_HOST -------------------------------------------------------
nameHost(){
    read -p "Qual o host do Banco? (Padrão local : localhost) = " host
    arrayInfo[host]=$host
}
nameHost
if [ "${arrayInfo[host]}" ]; then
  echo "DB_HOST=${arrayInfo[host]}" > config/db/.credentials
else
  echo "DB_HOST=localhost" >> config/db/.credentials
fi

echo "-"
echo "-"

# insert DB_PORT -------------------------------------------------------
portHost(){
    read -p "Qual a porta do Banco? (Padrão mysql : 3306) = " port
    arrayInfo[port]=$port
}
portHost
if [ "${arrayInfo[port]}" ]; then
  echo "DB_PORT=${arrayInfo[port]}" >> config/db/.credentials
else
  echo "DB_PORT=3306" >> config/db/.credentials
fi

echo "-"
echo "-"

# insert DB_CREATE_NEW -------------------------------------------------------
createDB(){
    read -p "Criar um banco novo para este projeto? (yes/no) = " newDB
    arrayInfo[newDB]=$newDB
}
createDB
if [ "${arrayInfo[newDB]}" ]; then
  echo "DB_CREATE_NEW=${arrayInfo[newDB]}" >> config/db/.credentials
else
  echo "DB_CREATE_NEW=no" >> config/db/.credentials
fi

echo "-"
echo "-"

# insert DB_NAME -------------------------------------------------------
nameDB(){
    read -p "Qual o nome do Banco existente/novo ? = " name
    arrayInfo[name]=$name
}
nameDB
if [ "${arrayInfo[name]}" ]; then
  echo "DB_NAME=${arrayInfo[name]}" >> config/db/.credentials
else
  echo "DB_NAME=nome_db_aleatorio" >> config/db/.credentials
fi

echo "-"
echo "-"

# insert DB_USERNAME -------------------------------------------------------
usernameDB(){
    read -p "Qual o nome do usuário do Banco? (Padrão root) = " username
    arrayInfo[username]=$username
}
usernameDB
if [ "${arrayInfo[username]}" ]; then
  echo "DB_USERNAME=${arrayInfo[username]}" >> config/db/.credentials
else
  echo "DB_USERNAME=root" >> config/db/.credentials
fi

echo "-"
echo "-"

# insert DB_PASSWORD -------------------------------------------------------
passwordDB(){
    read -p "Qual a senha do Banco? = " password
    passCrypt=`bash setup/crypt.sh $password`
    arrayInfo[password]=$passCrypt
}
passwordDB
if [ "${arrayInfo[password]}" ]; then
  echo "DB_PASSWORD=${arrayInfo[password]}" >> config/db/.credentials
else
  echo "DB_PASSWORD=" >> config/db/.credentials
fi

echo "-"
echo "-"
echo "----------------------- ##### Setup (Passo 1 Finalizado!) ##### -----------------------"