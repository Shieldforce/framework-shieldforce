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
# shellcheck disable=SC2215
# shellcheck disable=SC2220
# shellcheck disable=SC2128
# shellcheck disable=SC2166
# shellcheck disable=SC2120

# Informação da versão do framework
version()
{
  versionVar="1.0"
  echo "-----------------------------------------------------"
  echo "------------ Versão do Framework : $versionVar --------------"
  echo "-----------------------------------------------------"
}

if   [ $1 -a $1 = "--v" ]; then
  version
elif [ $2 -a $2 = "--v" ]; then
  version
elif [ $3 -a $3 = "--v" ]; then
  version
elif [ $4 -a $4 = "--v" ]; then
  version
fi

# Ajuda para usuários do sistema
helper()
{
  echo "-----------------------------------------------------"
  echo "----------------------- Helper ----------------------"
  echo "-----------------------------------------------------"
  echo ""
  echo "Opções: "
  echo ""
  echo "--help      : (Mostra conteúdo de ajuda do framework!)"
  echo "--v         : (Mostra versão do framework!)"
  echo "start-db    : (Inicia a criação das tabelas de sistema!)"
}

if   [ $1 -a $1 = "--help" ]; then
  helper
elif [ $2 -a $2 = "--help" ]; then
  helper
elif [ $4 -a $4 = "--help" ]; then
  helper
elif [ $5 -a $5 = "--help" ]; then
  helper
fi

# Start DB - Criando tabelas do sistema!
serverStart()
{

  if [ $port -a $host -a $path ]; then
        php -S $host:$port$path
  fi

  if [ $port -a $host ]; then
      php -S $host:$port
  fi

  if [ $port ]; then
    php -S localhost:$port
  fi

  if [ $host ]; then
    php -S $host:3000
  fi

  php -S localhost:3000
}

if [ $1 -a $1 = "--start-server" ]; then
  if [ $2 -a $2 = "--port" ]; then
      port=$3
  fi
  if [ $4 -a $4 = "--host" ]; then
      host=$5
  fi
  if [ $6 -a $6 = "--path" ]; then
        path=$7
    fi
  serverStart
fi

# Start System
startSystem()
{
  bash setup/start.sh
}

if [ $1 -a $1 = "--start-system" ]; then
  startSystem
fi





