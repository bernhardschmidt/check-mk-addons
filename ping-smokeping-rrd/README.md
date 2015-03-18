To use this template install it into your pnp-templates directory 
(e.g. local/share/check_mk/pnp-templates/ in OMD).

You should also deploy the following symlinks in the same directory
to cover all instances of the PING check.

```
cd local/share/check_mk/pnp-templates
ln -s check-mk-ping.php check_mk_active_ping.php
ln -s check-mk-ping.php check-mk-host-ping.php
```
