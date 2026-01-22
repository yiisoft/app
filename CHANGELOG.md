# Yii3 Web Application Template Change Log

## 1.1.1 under development

- Enh #424: Refactor `Makefile` default command help logic (@samdark)
- Enh #435: Set locale `C.UTF-8` in `Dockerfile` (@vjik)

## 1.1.0 December 20, 2025

- New #413, #414: Add Makefile `stop` goal for stopping Docker containers (@samdark, @vjik)
- Chg #412: Update structure in `src/` directory (@vjik)
- Enh #399: Improve message for missing or invalid APP_ENV (@samdark)
- Enh #404: Remove `<meta http-equiv="X-UA-Compatible" content="IE=edge">` from layout (@proweb)
- Enh #412, #420: Update composer dependencies (@vjik)
- Enh #412: Use relative path for Psalm cache directory (@vjik)
- Enh #415: Prune unused container and do not detach on `make prod-deploy` (@samdark)
- Enh #420: Add PHP 8.5 support (@vjik)
- Bug #402, #411: Always use only one goal in Makefile (@vjik)
- Bug #403: Add DI container delegates configuration (@vjik)
- Bug #409, #410: Fix fake goals in Makefile (@vjik)

## 1.0.0 August 25, 2025

- Initial release.
