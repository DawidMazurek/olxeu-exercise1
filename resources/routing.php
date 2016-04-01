<?php

return [
    ['GET', '/users/{id:me|\d+}', [\naspersclassifieds\olxeu\users\UserEndpoint::class, 'getMe']],
    ['GET', '/skills', [\naspersclassifieds\olxeu\skills\SkillEndpoint::class, 'listSkills']],
    ['PUT', '/skills', [\naspersclassifieds\olxeu\skills\SkillEndpoint::class, 'createSkill']],
    ['DELETE', '/skills', [\naspersclassifieds\olxeu\skills\SkillEndpoint::class, 'deleteAllSkills']],
    ['GET', '/skills/{id}', [\naspersclassifieds\olxeu\skills\SkillEndpoint::class, 'getSkill']],
    ['POST', '/skills/{id}', [\naspersclassifieds\olxeu\Skills\SkillEndpoint::class, 'updateSkill']],
    ['DELETE', '/skills/{id}', [\naspersclassifieds\olxeu\Skills\SkillEndpoint::class, 'deleteSkill']],
];
