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
# shellcheck disable=SC2140
# shellcheck disable=SC1078

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
  echo "--help
  // Informaçoes do comando --
  : (Mostra conteúdo de ajuda do framework!)
  -
  -"
  echo "--v
  // Informaçoes do comando --
  : (Mostra versão do framework!)
  -
  -"
  echo "bash sfrun.sh --start-server --host 'localhost' --port '9000' --path '/sufixo'
  // Informaçoes do comando --
  : (Inicia o servidor embutido do PHP!)
  - Lista de parâmetros --
  - [--host ( Nome do host local, exemplo: meusite.local )]
  - [--port ( Porta do servidor local )]
  - [--path ( Se o projeto precisar de um sufixo, exemplo: http://meuprojeto.com.br/sufixo )]
  -
  -"
  echo "sudo bash setup/start.sh --start-system --host 'localhost' --port '80' --path-public 'you_project/public'
  // Informaçoes do comando --
  : (Inicia o build do sistema!)
  - Lista de parâmetros --
  - [--host        ( Dominio do projeto, exemplo: meusite.com.br )]
  - [--port        ( Porta do servidor de hospedagem do projeto )]
  - [--path-public ( Se a pasta de publicação do seu projeto não for a raiz, informe a pasta de publicação. exemplo: /public ou /public_html )]
  -
  -"
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
  if    [ $port -a $host -a $path ]; then
          php -S $host:$port$path
  elif  [ $port -a $host ]; then
          php -S $host:$port
  elif  [ $port ]; then
          php -S localhost:$port
  elif  [ $host ]; then
          php -S $host:3000
  fi
  php -S localhost:3000
}

if [ $1 -a $1 = "--start-server" ]; then
  if    [ $2 -a $2 = "--host" ]; then
          host=$3
  elif  [ $4 -a $4 = "--port" ]; then
          port=$5
  elif  [ $6 -a $6 = "--path" ]; then
          path=$7
  fi
  serverStart
fi

# Start System
startSystem()
{
    sudo echo "127.0.0.1 ${host}" >> /etc/hosts
    echo "Local host adicionado no arquivo de hosts"
    echo "-"
    echo "-"
    echo "-"
    sudo echo "
    <VirtualHost *:${port}>
            # The ServerName directive sets the request scheme, hostname and port that
            # the server uses to identify itself. This is used when creating
            # redirection URLs. In the context of virtual hosts, the ServerName
            # specifies what hostname must appear in the request's Host: header to
            # match this virtual host. For the default virtual host (this file) this
            # value is not decisive as it is used as a last resort host regardless.
            # However, you must set it for any further virtual host explicitly.
            #ServerName www.example.com

            ServerName ${host}
            ServerAdmin webmaster@localhost
            DocumentRoot /var/www/html/${path}

            <Directory "/var/www/html/${path}">
               Options Indexes FollowSymLinks MultiViews
               AllowOverride All
               Order deny,allow
               allow from all
            </Directory>

            # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
            # error, crit, alert, emerg.
            # It is also possible to configure the loglevel for particular
            # modules, e.g.
            #LogLevel info ssl:warn

            ErrorLog ${APACHE_LOG_DIR}/error.log
            CustomLog ${APACHE_LOG_DIR}/access.log combined

            # For most configuration files from conf-available/, which are
            # enabled or disabled at a global level, it is possible to
            # include a line for only one particular virtual host. For example the
            # following line enables the CGI configuration for this host only
            # after it has been globally disabled with "a2disconf".
            #Include conf-available/serve-cgi-bin.conf
    </VirtualHost>
    # vim: syntax=apache ts=4 sw=4 sts=4 sr noet
    " >> /etc/apache2/sites-available/${host}'.conf'
    echo "Arquivo de virtual host adicionado na pasta de sites-avaliable"
    echo "-"
    echo "-"
    echo "-"
    sudo a2ensite ${host}'.conf'
    echo "VirtualHost ${host} habilitado no apache2"
    echo "-"
    echo "-"
    echo "-"
    sudo systemctl restart apache2
    echo "Apache2 reniciado!"
    echo "-"
    echo "-"
    echo "-"
    chmod -R 777 ./
}

if [ $1 -a $1 = "--start-system" ]; then
  if [ $2 -a $2 = "--host" ]; then
      host=$3
  fi
  if [ $4 -a $4 = "--port" ]; then
      port=$5
  fi
  if [ $6 -a $6 = "--path-public" ]; then
      path=$7
  fi
  startSystem
fi





