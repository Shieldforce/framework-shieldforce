# Framework Shield-Force
- Para desenvolvimento PHP!

### Dependências:
- PHP 8.1 FPM
- Composer
- Docker


### Baixando o projeto (Obrigatório)

```
git clone https://github.com/Shieldforce/framework-shieldforce.git framework-shieldforce.local
```

### Entrando na pasta do projeto (Obrigatório)

```
cd framework-shieldforce.local
```

### Rodando composer update (Obrigatório)

```
composer update
```

### Setup de instalação do Framework! (Obrigatório)

```
sudo bash setup/start.sh --host 'framework-shieldforce.local' --port '80' --path-public '/public'
```

### Criar alias sfrun (Obrigatório)

```
sfrun --create-alias --user alexandrefn
```

### Servidor Embutido (Opcional)

```
sfrun --start-server --host 'localhost' --port '3000' --path '/public'
```

### Comando de Ajuda (Opcional)

```
sfrun --help
```

### Versão Framework (Opcional)

```
sfrun --v
```

