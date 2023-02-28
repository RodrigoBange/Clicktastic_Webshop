<?php

class Product
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected $price;
    protected string $company;
    protected string $size;
    protected int $amountkeys;
    protected string $layout;
    protected string $backlit;
    protected bool $hotswap;
    protected string $color;
    protected string $material;
    protected string $switches;
    protected ?string $image;
    protected ?int $quantity;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getAmountkeys(): int
    {
        return $this->amountkeys;
    }

    /**
     * @param int $amountkeys
     */
    public function setAmountkeys(int $amountkeys): void
    {
        $this->amountkeys = $amountkeys;
    }

    /**
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    /**
     * @return string
     */
    public function getBacklit(): string
    {
        return $this->backlit;
    }

    /**
     * @param string $backlit
     */
    public function setBacklit(string $backlit): void
    {
        $this->backlit = $backlit;
    }

    /**
     * @return bool
     */
    public function isHotswap(): bool
    {
        return $this->hotswap;
    }

    /**
     * @param bool $hotswap
     */
    public function setHotswap(bool $hotswap): void
    {
        $this->hotswap = $hotswap;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getMaterial(): string
    {
        return $this->material;
    }

    /**
     * @param string $material
     */
    public function setMaterial(string $material): void
    {
        $this->material = $material;
    }

    /**
     * @return string
     */
    public function getSwitches(): string
    {
        return $this->switches;
    }

    /**
     * @param string $switches
     */
    public function setSwitches(string $switches): void
    {
        $this->switches = $switches;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }
}
