<?php

class Tagfield_Tagfield {

    /**
     *
     * @var Tagfield_DbTable_Tagfield 
     */
    private $table;

    public function __construct() {
        $pimDb = Pimcore_Resource_Mysql::get();
        $rev = Pimcore_Version::$revision;
        if ($rev > 1350) {
            Zend_Db_Table::setDefaultAdapter($pimDb->getResource());
        } else {
            Zend_Db_Table::setDefaultAdapter($pimDb);
        }



        $this->table = new Tagfield_DbTable_Tagfield();
    }

    /**
     *
     * @param string $key
     * @return array
     */
    public function getTagsByKey($key) {

        $select = $this->table->select();
        $select->where('`key` LIKE "' . $key . '"');
        $tags = $this->table->fetchAll($select);



        return $tags->toArray();
    }

    /**
     *
     * @param string $key
     * @return array
     */
    public function getTagListByKey($key) {
        $select = $this->table->select();
        $select->where('`key` LIKE "' . $key . '"');
        $tags = $this->table->fetchAll($select);
        $list = array();
        foreach ($tags as $tag) {
            array_push($list, $tag->tag);
        }



        return $list;
    }

    /**
     *
     * @param string $key
     * @param array $tags 
     */
    public function setTags($key, $tags) {
        $exTags = $this->getTagListByKey($key);
        if (is_array($tags)) {
            foreach ($tags as $tag) {
                if (!in_array($tag, $exTags)) {
                    $this->addTag($key, $tag);
                }
            }
        }
        return true;
    }

    /**
     *
     * @param string $key
     * @param string $tag
     * @return boolean
     */
    private function addTag($key, $tag) {
        $key = addslashes($key);
        $tag = addslashes($tag);

        if ($tag != "") {
            $ret = $this->table->insert(array("key" => $key, "tag" => $tag));
            return true;
        }
        return false;
    }

}

?>