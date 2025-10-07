# Abrir Profile y recargar
## Abrir 
```
if (!(Test-Path $PROFILE)) { New-Item -Path $PROFILE -Type File -Force }
>> notepad $PROFILE  -> Abrir el profile
```
## Recargar
```
. $PROFILE
```
## Comprobar si estan
```
Get-Command composer, serve 
```
## Lanzar
```
    serve
```
## Cerrar
``` 
    docker stop composer-server
```

# Funciones Profile
## Función para usar Composer a través de Docker
```
function composer {
    $currentDir = Get-Location
    if ($currentDir.Path -notmatch '^C:\\') {
        Write-Error "Error: Composer solo está configurado para rutas en C:\"
        return
    }
    $dockerPath = "//c/" + $currentDir.Path.Substring(3).Replace('\', '/')
    
    docker run -it --rm `
        -v "${dockerPath}:/home/developer/app" `
        -v "//c/Users/Victor M/AppData/Roaming/Composer:/home/developer/.composer" `
        composer-cli composer @args
}
```

## Función para iniciar un servidor PHP en Docker (accesible en http://localhost:8000)
```
function serve {
    $currentDir = Get-Location
    if ($currentDir.Path -notmatch '^C:\\') {
        Write-Error "Error: El servidor solo funciona con rutas en C:\"
        return
    }
    $dockerPath = "//c/" + $currentDir.Path.Substring(3).Replace('\', '/')
```
# Detener contenedor anterior si existe
```
    docker stop composer-server 2>$null | Out-Null
``` 
# Iniciar nuevo contenedor en segundo plano
    docker run -d --rm `
        --name composer-server `
        -p 8000:8000 `
        -v "${dockerPath}:/home/developer/app" `
        -w /home/developer/app `
        composer-cli `
        php -S 0.0.0.0:8000 -t public
    
    Write-Host "✅ Servidor iniciado en http://localhost:8000" -ForegroundColor Green
    Write-Host "📌 Para detenerlo, ejecuta: docker stop composer-server" -ForegroundColor Yellow
}
```

