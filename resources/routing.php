<?php

return [
    ['GET', '/users/{id:me|\d+}', [\naspersclassifieds\olxeu\users\UserEndpoint::class, 'getMe']],
];