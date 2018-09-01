FROM ubuntu:14.04
RUN apt-get update -q && DEBIAN_FRONTEND=noninteractive apt-get install -yq --no-install-recommends ca-certificates openssh-server  wget  apt-transport-https  vim  nano
RUN echo "deb https://packages.gitlab.com/gitlab/gitlab-ce/ubuntu/ `lsb_release -cs` main" > /etc/apt/sources.list.d/gitlab_gitlab-ce.list
RUN wget -q -O - https://packages.gitlab.com/gpg.key | apt-key add -
RUN apt-get update && apt-get install -yq --no-install-recommends gitlab-ce

RUN mkdir -p /opt/gitlab/sv/sshd/supervise && mkfifo /opt/gitlab/sv/sshd/supervise/ok \
       && printf "#!/bin/sh\nexec 2>&1\numask 077\nexec /usr/sbin/sshd -D" > /opt/gitlab/sv/sshd/run \
    && chmod a+x /opt/gitlab/sv/sshd/run && ln -s /opt/gitlab/sv/sshd /opt/gitlab/service&& mkdir -p /var/run/sshd


RUN echo "UseDNS no" >> /etc/ssh/sshd_config


RUN ( \
  echo "" && \
  echo "# Docker options" && \
  echo "# Prevent Postgres from trying to allocate 25% of total memory" && \
  echo "postgresql['shared_buffers'] = '1MB'" ) >> /etc/gitlab/gitlab.rb && \
  mkdir -p /assets/ && \
  cp /etc/gitlab/gitlab.rb /assets/gitlab.rb


EXPOSE 443 80 22


VOLUME ["/etc/gitlab", "/var/opt/gitlab", "/var/log/gitlab"]


COPY assets/wrapper /usr/local/bin/


CMD ["/usr/local/bin/wrapper"]