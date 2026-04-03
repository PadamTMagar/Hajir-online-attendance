@echo off
SET CONDA_ENV=C:\Users\acer\anaconda3\envs\facereco

SET PATH=%CONDA_ENV%;%CONDA_ENV%\Scripts;%CONDA_ENV%\Library\bin;%CONDA_ENV%\Library\mingw-w64\bin;%CONDA_ENV%\DLLs;%SystemRoot%\System32;%SystemRoot%;%PATH%

SET PYTHONHOME=%CONDA_ENV%
SET PYTHONPATH=%CONDA_ENV%\Lib\site-packages;%CONDA_ENV%\Lib;%CONDA_ENV%\DLLs

SET PYTHONNOUSERSITE=1

"%CONDA_ENV%\python.exe" "C:\xampp\htdocs\Hajir\algorithm\generate_encoding.py" %1 2>&1