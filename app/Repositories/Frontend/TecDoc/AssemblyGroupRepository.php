<?php


namespace App\Repositories\Frontend\TecDoc;


use App\Models\TecDoc\AssemblyGroup\AssemblyGroup;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;

class AssemblyGroupRepository extends BaseRepository
{
    const MODEL = AssemblyGroup::class;
    const CACHE_QUERY_KEY = 'query.assembly.groups';
    const CACHE_DATA_KEY = 'data.assembly.groups';
    const CACHE_TIME = 60 * 60;

    /**
     * @return array
     */
    public function getAssemblyGroupsAsArray()
    {
        return Cache::remember(self::CACHE_QUERY_KEY, self::CACHE_TIME, function () {
            return AssemblyGroup::orderBy('assemblyGroupName')->get()->toArray();
        });
    }

    /**
     * @return array
     */
    public function getAssemblyGroupsAsTree()
    {
        return Cache::remember(self::CACHE_DATA_KEY, self::CACHE_TIME, function () {
            $assemblyGroups = $this->getAssemblyGroupsAsArray();
            $assemblyGroups = $this->sortAssemblyGroupsByCategory($assemblyGroups);

            foreach ($assemblyGroups as &$assemblyGroupCategory) {
                $assemblyGroupCategory['assemblyGroups'] = $this->generateAssemblyGroupsTree($assemblyGroupCategory['assemblyGroups']);
            }

            return $assemblyGroups;
        });
    }

    /**
     * @param array $assemblyGroups
     * @return array
     */
    private function sortAssemblyGroupsByCategory($assemblyGroups)
    {
        $assemblyGroupsByCategory = [];

        foreach ($assemblyGroups as $assemblyGroup) {
            if (!array_key_exists($assemblyGroup['shortCutId'], $assemblyGroupsByCategory)) {
                $assemblyGroupsByCategory[$assemblyGroup['shortCutId']] = [
                    'shortCutId' => $assemblyGroup['shortCutId'],
                    'shortCutName' => $assemblyGroup['shortCutName'],
                    'assemblyGroups' => [],
                ];
            }

            $assemblyGroupsByCategory[$assemblyGroup['shortCutId']]['assemblyGroups'][] = $assemblyGroup;
        }

        unset($assemblyGroups);

        return $assemblyGroupsByCategory;
    }

    /**
     * @param array $assemblyGroups
     * @param integer $parentId
     * @return array
     */
    private function generateAssemblyGroupsTree(&$assemblyGroups, $parentId = null)
    {
        $assemblyGroupsTree = [];

        foreach ($assemblyGroups as $assemblyGroup) {
            if ($assemblyGroup['parentNodeId'] == $parentId) {
                $children = $this->generateAssemblyGroupsTree($assemblyGroups, $assemblyGroup['assemblyGroupNodeId']);

                if ($children) {
                    $assemblyGroup['children'] = $children;
                }

                $assemblyGroupsTree[$assemblyGroup['assemblyGroupNodeId']] = $assemblyGroup;
                unset($assemblyGroups[$assemblyGroup['assemblyGroupNodeId']]);
            }
        }

        return $assemblyGroupsTree;
    }
}
