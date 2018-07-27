FROM phalcon:v3.4.0

MAINTAINER taka2063

WORKDIR /root/

RUN cp /usr/share/zoneinfo/Japan /etc/localtime

RUN apt-get update
RUN apt-get -y install php5-curl

COPY asset/default.conf /etc/apache2/sites-available/
RUN a2dissite 000-default && \
    a2ensite default

ENV DEBIAN_FRONTEND noninteractive
RUN apt-get -y install mysql-server
ENV DEBIAN_FRONTEND dialog

VOLUME /var/lib/mysql

COPY asset/my.cnf /etc/mysql/
COPY asset/.bashrc /root/
COPY asset/.bash_profile /root/
