<?php

    abstract class AbstractEntity {

        protected $id;

        public function getId()
        {
            return $this->id;
        }

    }

    trait TimestampableTrait {

        protected $createdAt;
        protected $updatedAt;

        public function getCreatedAt()
        {
            return $this->createdAt;
        }

        public function setCreatedAt($createdAt)
        {
            $this->createdAt = $createdAt;
        }

        public function getUpdatedAt()
        {
            return $this->updatedAt;
        }

        public function setUpdatedAt($updatedAt)
        {
            $this->updatedAt = $updatedAt;
        }

    }

    interface EntityInterface {

        public function getId();
        public function getCreatedAt();
        public function getUpdatedAt();
    }

    class News extends AbstractEntity implements EntityInterface {

        use TimestampableTrait;

        public function getId()
        {

        }
        public function getCreatedAt()
        {

        }
        public function getUpdatedAt()
        {

        }

    }
