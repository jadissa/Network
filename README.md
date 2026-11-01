# Network

## Database
./database/migrations/2025_11_13_045540_create_ip_data_table.php
./database/migrations/2025_11_13_045540_create_display_fields_table.php
./config/database.php

## View
./resources/views/monitor/index.blade.php

## Request
./app/Models/Request.php
./routes/web.php

## Controller
./app/Http/Controllers/MonitorController.php

## Requires https://github.com/jadissa/os/tree/main/network
-- only the log script

## Monitor run
-- suggest `cd /your/path/network && sudo .venvs/MyEnv/bin/python ./scripts/traffic_logger.py`

## App db wipe/install
-- `php artisan config:clear && php artisan migrate:fresh -v`

## App run
-- `cd /your/path/Netowrk && php artisan serve`

## App update
-- `cd /your/path/Network && composer update`

## TODO
Now that I've integrated Abuse IP DB, I should see how we can use that score on the view
-- https://docs.abuseipdb.com/#reports-endpoint