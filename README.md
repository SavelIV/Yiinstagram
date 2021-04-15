A pet project.

Yiinstagram is a small analogue of the well-known resource for sharing photos and various information, built on Yii2 framework.

The goal is to keep photo diaries online, the ability to make friends and make acquaintances, share photos and impressions, follow the latest world news and the news of friends.

Key features:

Creating and editing of your own profile.
Uploading and publishing of your profile photos.
The ability to make friends and subscribe to other network members.
Update feed with the ability to comment and like.
Authorization through various social networks.
Subscription to the daily newsletters.
Alerts page: likes and subscriptions to the user`s profile.
Pages with lists of subscriptions and followers.
Full-text search for publications.
Ability to send complaints about other members publications.
Administrative panel for handling complaints and managing users.
This project is made on the Yii2 framework using MySQL, Redis (likes, dislikes, subscriptions, followers, complaints about posts), Sphinx (full-text search).

There is oAuth authorization implemented, console mail scripts run.

There is original principles of user files storing are applied, the watermark is used (intervention library).

The high performance news feed (user posts) is formed (instant updates for all subscribers).

Hourly updated by cron parser of the leading Russian news Internet sites is implemented.

The administration system is based on roles (RBAC).

Full internationalization done (i18n).

Functional and unit tests are written.

-------------------------------------------------------------------------------------------------------------------------------------------

Yiinstagram - небольшой аналог известного ресурса для обмена фотографиями и различной информацией, построенный на фреймворке Yii2.

Цель - ведение фото-дневников онлайн, возможность дружить и заводить знакомства, делиться фотографиями и впечатлениями, следить за последними мировыми новостями и новостями знакомых.

Основные возможности:

Создание и редактирование собственного профиля.
Загрузка и публикация фотографий в профиль.
Возможность заводить друзей и подписываться на других участников сети.
Лента обновлений с возможностью комментировать и ставить лайки.
Возможность регистрироваться на сайте через различные социальные сети.
Подписка на ежедневную рассылку свежих новостей.
Страница оповещений: лайки и подписки на профиль пользователя.
Страницы со списками подписок и подписчиков.
Полнотекстовый поиск по публикациям.
Возможность отправлять жалобы на публикации других участников.
Административная панель для рассмотрения жалоб и управления пользователями.
Данный проект сделан на фреймворке Yii2 с использованием MySQL, Redis (лайки, дизлайки, подписки, фолловеры, жалобы на посты), Sphinx (полнотекстовый поиск).

Реализована oAuth авторизация, работают консольные скрипты почтовой рассылки.

Применены оригинальные принципы хранения файлов пользователей, используется watermark (библиотека intervention).

Лента новостей (постов пользователей) сформирована с учетом высокого быстродействия (мгновенное обновление у всех подписчиков).

Реализован парсер новостей с ведущих Российских интернет площадок, ежечасно обновляемый по крону.

Система администрирования построена на основе ролей (RBAC).

Сделана полная интернационализация (i18n).

Написаны функциональные и модульные тесты.
