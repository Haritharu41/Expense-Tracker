<?php
class ExpenseData
{
    private $id;
    private $amount;
    private $category;
    private $date;
    private $description;

    public function __construct($id, $amount, $category, $date, $description)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->category = $category;
        $this->date = $date;
        $this->description = $description;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDetails()
    {
        return [
            "id" => $this->id,
            'amount' => $this->amount,
            'category' => $this->category,
            'date' => $this->date,
            'description' => $this->description
        ];
    }
}
