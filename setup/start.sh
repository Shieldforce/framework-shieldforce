#!/bin/sh
# shellcheck disable=SC2039
# shellcheck disable=SC2154
# shellcheck disable=SC2046
# shellcheck disable=SC2088
# shellcheck disable=SC2139
# shellcheck disable=SC2024
# shellcheck disable=SC2089
# shellcheck disable=SC2090
# shellcheck disable=SC1090
# shellcheck disable=SC2232

read -p "Deseja mesmo rodar o start system? (Todos os dados de .env serão resetados para configuração Padrão!) [Opções yes ou no] : " start
if [ $start = 'yes' ]; then
  echo "Configuração Start Aceita!"
else
  echo "Você decidiu não resetar o sistema!"
  exit;
fi

echo "-"
echo "-"

echo "----------------------- ##### Setup (Passo 1 Iniciado!) ##### -----------------------"
echo "-"
echo "-"
echo "- Informações do banco : "
echo -n > .env

pathSfRun="'$(pwd)/sfrun.sh'"
chmod 777 $(pwd)/sfrun.sh
strAlias="alias sfrun=$pathSfRun"
fileBashRc="/home/alexandrefn/.bashrc"

echo "# Root path is project ----------" > .env
echo "ROOT_PATH=$(pwd)" >> .env
echo "" >> .env

echo "# Name is project ----------" >> .env
echo "APP_NAME=NameIsProject" >> .env
echo "" >> .env

echo "# Url of access is project ----------" >> .env
echo "APP_URL=http://localhost" >> .env
echo "" >> .env

echo "# Url of access is project ----------" >> .env
echo "AMBIENT=local" >> .env
echo "" >> .env

echo "# On debug is develop ----------" >> .env
echo "ERROR_DEBUG=true" >> .env
echo "" >> .env

echo "# On maintenance is system ----------" >> .env
echo "APP_MAINTENACE=false" >> .env
echo "" >> .env

echo "# Connection (1) ----------" >> .env
echo "DB_CONNECTION_1=mysql" >> .env

if grep -q $pathSfRun "$fileBashRc"; then
  echo "Já existe o alias";
else
  sudo echo $strAlias >> $fileBashRc
  source "$fileBashRc"
fi

declare  -A arrayInfo

# insert DB_HOST -------------------------------------------------------
nameHost(){
    read -p "Qual o host do Banco? (Padrão local : localhost) = " host
    arrayInfo[host]=$host
}
nameHost
if [ "${arrayInfo[host]}" ]; then
  echo "DB_HOST_1=${arrayInfo[host]}" >> .env
else
  echo "DB_HOST_1=localhost" >> .env
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
  echo "DB_PORT_1=${arrayInfo[port]}" >> .env
else
  echo "DB_PORT_1=3306" >> .env
fi

echo "-"
echo "-"

# insert DB_PORT -------------------------------------------------------
driverDB(){
    read -p "Qual o driver será usado? (Padrão mysql, Opções : [mysql,sqlserver,postgresql]) = " driver
    arrayInfo[driver]=$driver
}
driverDB
if [ "${arrayInfo[driver]}" ]; then
  echo "DB_DRIVER_1=${arrayInfo[driver]}" >> .env
else
  echo "DB_DRIVER_1=mysql" >> .env
fi

echo "-"
echo "-"

# insert DB_NAME -------------------------------------------------------
nameDB(){
    read -p "Qual o nome do Banco ? (Padrão : framework_shieldforce) = " name
    arrayInfo[name]=$name
}
nameDB
if [ "${arrayInfo[name]}" ]; then
  echo "DB_NAME_1=${arrayInfo[name]}" >> .env
else
  echo "DB_NAME_1=framework_shieldforce" >> .env
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
  echo "DB_USERNAME_1=${arrayInfo[username]}" >> .env
else
  echo "DB_USERNAME_1=root" >> .env
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
  echo "DB_PASSWORD_1=${arrayInfo[password]}" >> .env
else
  echo "DB_PASSWORD_1=" >> .env
fi

echo "#--------------- End connection 1 ||" >> .env

echo "" >> .env
echo "# Connection (2) ----------" >> .env
echo "#DB_CONNECTION_2=mysql2" >> .env
echo "#DB_HOST_2=localhost" >> .env
echo "#DB_PORT_2=3306" >> .env
echo "#DB_DRIVER_2=mysql" >> .env
echo "#DB_NAME_2=" >> .env
echo "#DB_USERNAME_2=root" >> .env
echo "#DB_PASSWORD_2=" >> .env
echo "#--------------- End connection 2 ||" >> .env


echo "-"
echo "-"
echo "----------------------- ##### Setup (Passo 1 Finalizado!) ##### -----------------------"