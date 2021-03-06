<?php
/*
 *    Copyright 2008-2009 Laurent Eschenauer and Alard Weisscher
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 *  
 */
class LastfmItem extends SourceItem {

	protected $_prefix 	= 'lastfm';
	
	protected $_preamble = 'Liked the song: ';
	
	public function getType() {
		return SourceItem::LINK_TYPE;
	}

	public function getTitle() {
		if ($this->_data['title']) {
			return $this->_data['title'];
		} else {
			return "{$this->_data['name']} by {$this->_data['artist']}";
		}
	}	
	
	public function setTitle($title) {
		$db = Zend_Registry::get('database');
		$sql = "UPDATE `lastfm_data` SET `title`=:title "
			 . "WHERE source_id = :source_id AND id = :item_id ";
		$data 		= array("source_id" 	=> $this->getSource(),
							"item_id"		=> $this->getID(),
							"title"			=> $title);
							
 		return $db->query($sql, $data);
	}
	
	public function getLink() {
		return $this->_data['url'];
	}
	
	public function setLink($link) {
		$db = Zend_Registry::get('database');
		$sql = "UPDATE `lastfm_data` SET `url`=:link "
			 . "WHERE source_id = :source_id AND id = :item_id ";
		$data 		= array("source_id" 	=> $this->getSource(),
							"item_id"		=> $this->getID(),
							"link"			=> $link);
							
 		return $db->query($sql, $data);
	}
	
	public function getDescription() {
		return $this->_data['note'];
	}
	
	public function setDescription($description) {
		$db = Zend_Registry::get('database');
		$sql = "UPDATE `lastfm_data` SET `note`=:description "
			 . "WHERE source_id = :source_id AND id = :item_id ";
		$data 		= array("source_id" 	=> $this->getSource(),
							"item_id"		=> $this->getID(),
							"description"	=> $description);
							
 		return $db->query($sql, $data);
	}
	
	
	public function getBackup() {
		$item = array();
		$item['Link']				= $this->getLink();
		$item['Artist']				= $this->_data['artist'];
		$item['Name']				= $this->_data['name'];
		$item['Date']				= $this->_data['date'];		
		return $item;
	}
}