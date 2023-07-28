## How to set up Homestead development environment on Windows
Refer to [https://laravel.com/docs/8.x/homestead](https://laravel.com/docs/8.x/homestead) for official document about Laravel Homestead

1. Install **git**, download the installer from [https://git-scm.com/downloads](https://git-scm.com/downloads);


2. Install **php**, you can use a php Windows installer or a WAMP server. The local php interpreter is needed for composer and PhpStorm.


3. Install **composer**, download the installer from [https://getcomposer.org/download/](https://getcomposer.org/download/);


4. Install **npm**, download the node.js installer from [https://nodejs.org/en/download/](https://nodejs.org/en/download/);


5. Install **PhpStorm**, with **laravel plugin**


6. Install **VirtualBox**
    - Download the installer from [https://www.virtualbox.org/wiki/Downloads](https://www.virtualbox.org/wiki/Downloads)
    - The Virtualization (VT) from the Bios of your machine needs to be enabled if not. File a request to IT to enable it


7. Install **Vagrant**, download the installer from [https://www.vagrantup.com/downloads](https://www.vagrantup.com/downloads)


8. Generate SSH key (public/private rsa key pair)
    - Run ```ssh-keygen -t rsa -C "youremail@qiagen.com"```, use your own email address


8. Install **PhpMyAdmin** (optional)
    - Download PhpMyAdmin from [https://www.phpmyadmin.net/](https://www.phpmyadmin.net/)
    - Unzip it and renamed to C:/phpMyAdmin


9. Clone the repo from Gitlab
    - On c:\, run **git clone https://github.com/qiagenpims/pimsv2.git pimsv2**
    - Go to c:\pimsv2
    - Run **composer install** to install required packages
    - Run **npm install**, **npm run build** to install JavaScript and Tailwind CSS.
    - Create and edit **.env** file by copy the **.env.example** file
    - Run **php artisan key:generate** to create and set APP_KEY inside the .env file


10. Setup Homestead
    - Create and edit **Homestead.yaml** file by copy the **Homestead.yaml.example** file
    - For a new project without existing **Homestead.yaml.example** file, you need to install Homestead into your project
        - run ```composer require laravel/homestead --dev```
        - run ```vendor/bin/homestead make``` to make a Homestead.yaml file
        - Edit the Homestead.yaml file, change site name, database etc.


11. Setup hosts on Windows
    - edit windows **hosts** file at C:\Windows\System32\drivers\etc, add below lines
       ```
         192.168.10.10  pimsv2.test
         192.168.10.10  phpmyadmin.test
       ```  
    - you need to open a text editor like TextPad as administrator to edit the hosts file
    

12. Run Virtual Machine
    - Go to c:/pimsv2
    - Run **vagrant up** to bring up the virtual machine, it will take a while for the first time.
    - Run **vagrant ssh** to ssh to the virtual machine (password is 'vagrant' if being asked)
    - On the virtual machine, go to **/home/vagrant/code**, where the project is deployed on the virtual machine
    - On the virtual machine, run **php artisan migrate:fresh --seed** to create database tables
    - You can also run Vagrant commands from PhpStorm under "tools->Vagrant"
    - You can see you virtual machine status from the Oracle VM VirtualBox Manager program
    - Run **vagrant halt** to shut down the virtual machine if not used
    - Run **vagrant reload** to reboot the virtual machine if needed
    - Note that the virtual machine will be saved as a folder **pimsv2** under C:\Users\YourUserId\VirtualBox VMs, you might need to delete the folder pimsv2 to reload the virtual machine sometimes. If the folder cannot be deleted because it's in use by other program. Go to Windows Task Manager to end the VirtualBox Frontend processes.


13. Site Access:
    - You can access your local site from [http://pimsv2.test](http://pimsv2.test)
    - You can access your local PhpMyAmin from [http://phpmyadmin.test](http://phpmyadmin.test).
      The MySQL Database username and password is **homestead** / **secret**
    - Note that to connect to the MySQL from other database clients on your machine, you should connect to **127.0.0.1** on port **33060**.


14. Working Environment
    - You should work on the virtual machine (run php artisan commands like test, tinker, migrate, config, cache etc.) after run vagrant ssh, where the php, mysql and Nginx server are installed.
    - If you want to work in a PhpStorm console, you need to config it to use the remote php interpreter on the virtual machine. Refer to [https://www.jetbrains.com/help/phpstorm/configuring-remote-interpreters.html](https://www.jetbrains.com/help/phpstorm/configuring-remote-interpreters.html).


15. Testing Environment
    - A **.env.testing** file is used for the testing environment automatically when running phpunit testings. Note that sometimes .env.testing is not loaded, you need to run **php artisan config:clear** to clear the cache to make it work.
    - The database **pims_test** is created as the testing database to separate it from the production database **pims**
    - To run other **php artisan** commands under the testing environment, add the **--env=testing** option


16. Miscellaneous
    - To cleanly re-seed database, run **php artisan optimize**, followed by **php artisan migrate:fresh --seed**
    - To enforce a specific homestead version, add the following line to **Homestead.yaml** file
       ```
         box: laravel/homestead
         version: 11.3.0
       ```
    - To manually forward ports from VM to local host, add the following line to **Homestead.yaml** file
       ```
         ports:
         - send: 33060
           to: 3306
       ```        
    - Virtualbox v6.1.28(and later) only supports IP Address in 192.68.56.0/21 range to be assigned to host-only adapters.<br>
      To use a IP address 192.68.56.10, instead of 192.68.10.10, we need to update homestead.yaml
       ```
         ip: 192.168.56.10
       ```    
      Also edit windows **hosts** file at C:\Windows\System32\drivers\etc,
       ```
         192.168.56.10  pimsv2.test
         192.168.56.10  phpmyadmin.test
       ```
      Otherwise, "http://pimsv2.test" might not be accessible from host machine
    
