<?php
namespace VNF\RecordDriver;
use VuFind\RecordDriver\SolrDefault;


// TODO: unify with SolrMarcMerged in MZKPortal module (move to MZKCommon?)
class SolrMarcMerged extends SolrDefault
{

    public function getMergedIds() {
        return isset($this->fields['local_ids_str_mv']) ?
            $this->fields['local_ids_str_mv'] : array();
    }

    public function getInstitutionsWithIds() {
        $ids = $this->getMergedIds();
        $result = array();
        foreach ($ids as $id) {
            list($source, $localId) = explode('.', $id);
            $result[$source] = $id;
        }
        ksort($result);
        return $result;
    }

    public function getAvailabilityID() {
        return null;
    }

}