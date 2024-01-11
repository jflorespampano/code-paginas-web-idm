## instalar git desde
[GIT](https://git-scm.com/)

## 1 configuracion de git <a name="config"></a>
```sh
git config --global user.name "mi nombre en git hub"
git config --global user.email "miemail@mail"
#muestra la configuración actual
git config --global -e
```

## 2 clonar repositorio/bajar <a name="bajar_repo"></a>
```sh
#crear carpeta proyecto
#arrancar gitbash ahi
#o
mkdir proyecto
cd proyecto
git init
#cambiar el nombre de la rama principal a main
git branch -m main
git remote add origin https://github.com...
#bajar el proyecto
git pull origin main
