<?php

namespace naspersclassifieds\olxeu\skills;

use naspersclassifieds\olxeu\app\Cache;
use naspersclassifieds\olxeu\app\Exception;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;

class SkillEndpoint
{

    private $cache;
    public function __construct()
    {
        $this->cache = new Cache();
    }

    /**
     * @param ServerRequest $request
     * @return JsonResponse
     */
    public function createSkill(ServerRequest $request)
    {
        $result = LegacyStorage::add($request->getParsedBody());
        return new JsonResponse(['id' => $result]);
    }

    /**
     * @param string $id
     * @param ServerRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function updateSkill($id, ServerRequest $request)
    {
        $bind = $request->getParsedBody();
        $bind['id'] = $id;
        $result = LegacyStorage::update($bind, 'id="' . filter_var($id, FILTER_SANITIZE_STRING).'"');
        return new JsonResponse(['success' => $result]);
    }

    public function listSkills()
    {
        $result = LegacyStorage::find(true);
        return new JsonResponse($result);
    }

    public function getSkill($id)
    {
        $result = json_decode($this->cache->get('skill-'.$id));
        if (empty($result)) {
            $result = LegacyStorage::find('id="' . filter_var($id, FILTER_SANITIZE_STRING) . '"');
            $this->cache->set('skill-'.$id, json_encode($result));
        }
        return new JsonResponse($result);
    }

    public function deleteSkill($id)
    {
        $this->cache->set('skill-'.$id, null);
        $result = LegacyStorage::delete('id="' . filter_var($id, FILTER_SANITIZE_STRING).'"');
        return new JsonResponse(['success' => $result]);
    }

    public function deleteAllSkills()
    {
        $this->cache->clear();
        $result = LegacyStorage::delete(true);
        return new JsonResponse(['success' => $result]);
    }
}
