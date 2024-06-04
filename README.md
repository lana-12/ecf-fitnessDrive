# FitnessDrive 

## Content
This application is primarily intended for FitnessDRIVE employees. From their own space, they can manage access to the various options offered by FitnessDRIVE to the brand's franchisees. From this interface, franchisees can only see their activated options and the rooms they own. Only employees can modify rights.

---
## Read-only access code
- Franchise
    - id  : avenger@exemple.fr
    - mdp : avenger

- its structure 
    - id  : gamora@exemple.fr
    - mdp : gamora

- Admin
   - id  : fitnessdrive.ad01@outlook.com
   - mdp : admin

---

## Installation


``` bash
git clone https://github.com/lana-12/ecf-fitnessDrive.git

composer install
npm install
npm run build

symfony serve:start
# en http
php -S localhost:8000 -t public

symfony serve:stop


```


