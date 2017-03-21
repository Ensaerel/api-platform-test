FROM nginx:1.10

COPY nginx.conf /etc/nginx/
COPY website.template /etc/nginx/conf.d/
COPY run.sh /home/run.sh
RUN chmod +x /home/run.sh
