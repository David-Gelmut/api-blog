FROM node:20.16.0

ENV APP_ROOT /var/www/frontend

WORKDIR ${APP_ROOT}
ADD . ${APP_ROOT}

RUN npm install

RUN npm run build
CMD npm run dev

