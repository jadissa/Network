# Network

## Requires https://github.com/jadissa/os/tree/main/network
-- only the log script

## Monitor run
-- suggest `cd /your/path/network && sudo .venvs/MyEnv/bin/python ./scripts/traffic_logger.py`

## App db wipe/install
-- `php artisan config:clear && php artisan migrate:fresh -v`

## App run
-- `cd /your/path/Netowrk && php artisan serve`