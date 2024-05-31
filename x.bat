@echo off
:loop
start "" "%~dp0x.exe"
timeout /t 600 /nobreak
goto loop
