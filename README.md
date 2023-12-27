# FitnessDrive [Lien](https://fitnessdrive.fly.dev/)

## Content
This application is primarily intended for FitnessDRIVE employees. From their own space, they can manage access to the various options offered by FitnessDRIVE to the brand's franchisees. From this interface, franchisees can only see their activated options and the rooms they own. Only employees can modify rights.

---
## Read-only access code
- Franchise Toulouse 
    - id  : ibanez@exemple.fr
    - mdp : ibanezibanez

- its structure 
    - id  : trinhduc@exemple.fr
    - mdp : trinhductrinhduc

- Admin
    - Vous pouvez voir le rendu sur le mode d'emploi. [Lien](https://github.com/lana-12/ecf-fitnessDrive/blob/main/annexes/Mode%20d%20Emploi.pdf)
---

## Installation


``` bash
git clone https://github.com/lana-12/ecf-fitnessDrive.git

composer install

symfony serve:start
# en http
php -S localhost:8000 -t public

symfony serve:stop


```


