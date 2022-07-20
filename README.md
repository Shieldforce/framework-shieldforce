# Framework Shield-Force
- Para desenvolvimento PHP!

### Dependências:
- PHP 8.1 FPM
- Composer
- Docker


### Baixando o projeto (Obrigatório)

```
git clone https://github.com/Shieldforce/framework-shieldforce.git fsf.local
```

### Entrando na pasta do projeto (Obrigatório)

```
cd fsf.local
```

### Rodando composer update (Obrigatório)

```
composer update
```

### Setup de instalação do Framework! (Obrigatório)

```
sudo bash setup/start.sh --start-system --host 'fsf.local' --port '80' --path-public 'projects/fsf.local/public'
```

### Servidor Embutido (Opcional)

```
sudo bash setup/start.sh --start-server --host 'localhost' --port '3000' --path '/public'
```

### Comando de Ajuda (Opcional)

```
sudo bash setup/start.sh --help
```

### Versão Framework (Opcional)

```
sudo bash setup/start.sh --v
```

