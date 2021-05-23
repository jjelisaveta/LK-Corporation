<?php

namespace App\Models\Proxies\__CG__\App\Models\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Korisnik extends \App\Models\Entities\Korisnik implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'idkor', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'ime', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'prezime', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'email', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'brojtelefona', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'lozinka', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'adresa', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'slika', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'odobren', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'idulo'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'idkor', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'ime', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'prezime', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'email', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'brojtelefona', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'lozinka', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'adresa', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'slika', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'odobren', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'idulo'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Korisnik $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getIme()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIme', []);

        return parent::getIme();
    }

    /**
     * {@inheritDoc}
     */
    public function getIdkor(): int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getIdkor();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdkor', []);

        return parent::getIdkor();
    }

    /**
     * {@inheritDoc}
     */
    public function getPrezime(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrezime', []);

        return parent::getPrezime();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function getBrojtelefona(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBrojtelefona', []);

        return parent::getBrojtelefona();
    }

    /**
     * {@inheritDoc}
     */
    public function getLozinka(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLozinka', []);

        return parent::getLozinka();
    }

    /**
     * {@inheritDoc}
     */
    public function getAdresa(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdresa', []);

        return parent::getAdresa();
    }

    /**
     * {@inheritDoc}
     */
    public function getSlika(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSlika', []);

        return parent::getSlika();
    }

    /**
     * {@inheritDoc}
     */
    public function getOdobren(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOdobren', []);

        return parent::getOdobren();
    }

    /**
     * {@inheritDoc}
     */
    public function getIdulo(): \App\Models\Entities\Uloga
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdulo', []);

        return parent::getIdulo();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdkor(int $idkor): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdkor', [$idkor]);

        parent::setIdkor($idkor);
    }

    /**
     * {@inheritDoc}
     */
    public function setPrezime(string $prezime): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrezime', [$prezime]);

        parent::setPrezime($prezime);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail(string $email): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function setBrojtelefona(string $brojtelefona): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBrojtelefona', [$brojtelefona]);

        parent::setBrojtelefona($brojtelefona);
    }

    /**
     * {@inheritDoc}
     */
    public function setLozinka(string $lozinka): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLozinka', [$lozinka]);

        parent::setLozinka($lozinka);
    }

    /**
     * {@inheritDoc}
     */
    public function setAdresa(string $adresa): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAdresa', [$adresa]);

        parent::setAdresa($adresa);
    }

    /**
     * {@inheritDoc}
     */
    public function setSlika(?string $slika): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSlika', [$slika]);

        parent::setSlika($slika);
    }

    /**
     * {@inheritDoc}
     */
    public function setOdobren(string $odobren): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOdobren', [$odobren]);

        parent::setOdobren($odobren);
    }

    /**
     * {@inheritDoc}
     */
    public function setIdulo(\App\Models\Entities\Uloga $idulo): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdulo', [$idulo]);

        parent::setIdulo($idulo);
    }

}
